import React, { useEffect, useState } from 'react';
import { getCompanyDashboard } from '../../services/api';

const CompanyDashboard = () => {
    const [stats, setStats] = useState({ jobs: 0, applicants: 0 });

    useEffect(() => {
        getCompanyDashboard().then(data => setStats(data));
    }, []);

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold">Company Dashboard</h1>

            <div className="grid grid-cols-2 gap-4 mt-4">
                <div className="p-4 bg-purple-500 text-white rounded-lg">
                    <h2 className="text-xl">Total Lowongan</h2>
                    <p className="text-3xl">{stats.jobs}</p>
                </div>
                <div className="p-4 bg-red-500 text-white rounded-lg">
                    <h2 className="text-xl">Total Pelamar</h2>
                    <p className="text-3xl">{stats.applicants}</p>
                </div>
            </div>
        </div>
    );
};

export default CompanyDashboard;
