import React, { useEffect, useState } from 'react';
import { getDashboardStats } from '../../services/api';

const AdminDashboard = () => {
    const [stats, setStats] = useState({ jobs: 0, alumni: 0, companies: 0 });

    useEffect(() => {
        getDashboardStats('admin').then(data => setStats(data));
    }, []);

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold">Admin Dashboard</h1>
            <div className="grid grid-cols-3 gap-4 mt-4">
                <div className="p-4 bg-blue-500 text-white rounded-lg">
                    <h2 className="text-xl">Total Lowongan</h2>
                    <p className="text-3xl">{stats.jobs}</p>
                </div>
                <div className="p-4 bg-green-500 text-white rounded-lg">
                    <h2 className="text-xl">Total Alumni</h2>
                    <p className="text-3xl">{stats.alumni}</p>
                </div>
                <div className="p-4 bg-yellow-500 text-white rounded-lg">
                    <h2 className="text-xl">Total Perusahaan</h2>
                    <p className="text-3xl">{stats.companies}</p>
                </div>
            </div>
        </div>
    );
};

export default AdminDashboard;
