import React, { createContext, useContext, useState } from 'react';
import translations from './translations';

const I18nContext = createContext({ locale: 'en', t: () => '', setLocale: () => {} });

function getNested(obj, path) {
    return path.split('.').reduce((o, k) => (o || {})[k], obj);
}

export function I18nProvider({ children }) {
    const [locale, setLocale] = useState('en');
    const t = (key) => getNested(translations[locale] || translations.en, key) || key;
    return (
        <I18nContext.Provider value={{ locale, t, setLocale }}>
            {children}
        </I18nContext.Provider>
    );
}

export function useI18n() {
    return useContext(I18nContext);
}
