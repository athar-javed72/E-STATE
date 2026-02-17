import React from 'react';
import { NavLink } from 'react-router-dom';
import { useI18n } from '../i18n/I18nProvider';

export function Sidebar() {
    const { t } = useI18n();
    return (
        <aside className="fsm-sidebar" style={{ minWidth: 220, background: '#1e293b', color: '#fff', padding: 16 }}>
            <nav>
                <NavLink to="/" end style={({ isActive }) => ({ color: isActive ? '#38bdf8' : '#94a3b8', display: 'block', padding: 8 })}>
                    {t('app.dashboard')}
                </NavLink>
                <NavLink to="/projects" style={({ isActive }) => ({ color: isActive ? '#38bdf8' : '#94a3b8', display: 'block', padding: 8 })}>
                    {t('app.projects')}
                </NavLink>
            </nav>
        </aside>
    );
}
