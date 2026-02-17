import './bootstrap';

import { createRoot } from 'react-dom/client';
import React from 'react';
import { BrowserRouter } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ThemeProvider } from './fsm/theme/ThemeProvider';
import { I18nProvider } from './fsm/i18n/I18nProvider';
import { AppShell } from './fsm/AppShell';

const queryClient = new QueryClient();

const container = document.getElementById('fsm-root');

if (container) {
    const root = createRoot(container);

    root.render(
        <React.StrictMode>
            <QueryClientProvider client={queryClient}>
                <ThemeProvider>
                    <I18nProvider>
                        <BrowserRouter>
                            <AppShell />
                        </BrowserRouter>
                    </I18nProvider>
                </ThemeProvider>
            </QueryClientProvider>
        </React.StrictMode>,
    );
}
