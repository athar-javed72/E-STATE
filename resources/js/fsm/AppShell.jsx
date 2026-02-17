import React from 'react';
import { Routes, Route } from 'react-router-dom';
import { Sidebar } from './components/Sidebar';
import { Topbar } from './components/Topbar';
import { DashboardPage } from './pages/DashboardPage';
import { ProjectsPage } from './pages/ProjectsPage';

export function AppShell() {
    return (
        <div className="fsm-app" style={{ display: 'flex', minHeight: '100vh' }}>
            <Sidebar />
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
                <Topbar />
                <main style={{ flex: 1, overflow: 'auto' }}>
                    <Routes>
                        <Route path="/" element={<DashboardPage />} />
                        <Route path="/projects" element={<ProjectsPage />} />
                    </Routes>
                </main>
            </div>
        </div>
    );
}
