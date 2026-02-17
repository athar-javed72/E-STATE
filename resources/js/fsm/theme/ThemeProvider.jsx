import React, { createContext, useContext, useState } from 'react';

const ThemeContext = createContext({ theme: 'light', setTheme: () => {} });

export function ThemeProvider({ children }) {
    const [theme, setTheme] = useState('light');
    return (
        <ThemeContext.Provider value={{ theme, setTheme }}>
            <div data-theme={theme} className={theme}>
                {children}
            </div>
        </ThemeContext.Provider>
    );
}

export function useTheme() {
    return useContext(ThemeContext);
}
