import { ref, onMounted, watchEffect } from 'vue';

// Usar um "composable" torna a lógica reutilizável em qualquer componente
export function useDarkMode() {
    // `ref` para o estado reativo
    const isDarkMode = ref(false);

    // Função para aplicar o estado ao DOM e localStorage
    const setDarkMode = (value: boolean) => {
        isDarkMode.value = value;
        if (value) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    };

    // Botão de toggle
    const toggleDarkMode = () => {
        setDarkMode(!isDarkMode.value);
    };

    // Lógica ao carregar o componente
    onMounted(() => {
        const storedTheme = localStorage.getItem('theme');

        if (storedTheme) {
            // 1. Usa a preferência salva no localStorage
            setDarkMode(storedTheme === 'dark');
        } else {
            // 2. Se não houver, usa a preferência do Sistema Operacional
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            setDarkMode(prefersDark);
        }
    });

    // Opcional: Ouve mudanças no S.O.
    watchEffect(() => {
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        const handleChange = (e: MediaQueryListEvent) => {
            // Só muda pelo S.O. se o usuário não tiver uma preferência salva
            if (!localStorage.getItem('theme')) {
                setDarkMode(e.matches);
            }
        };

        mediaQuery.addEventListener('change', handleChange);
        // Cleanup
        return () => mediaQuery.removeEventListener('change', handleChange);
    });

    return {
        isDarkMode,
        toggleDarkMode,
    };
}
