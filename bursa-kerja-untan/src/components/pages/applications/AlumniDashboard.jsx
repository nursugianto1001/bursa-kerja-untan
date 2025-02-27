import React, { useEffect, useState } from 'react';
import { getAlumniDashboard } from '../../services/api';
import JobCard from '../../components/JobCard';

const AlumniDashboard = () => {
    const [jobs, setJobs] = useState([]);
    const [applications, setApplications] = useState([]);

    useEffect(() => {
        getAlumniDashboard().then(data => {
            setJobs(data.jobs);
            setApplications(data.applications);
        });
    }, []);

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold">Alumni Dashboard</h1>

            <h2 className="text-xl mt-4">Lowongan Kerja Tersedia</h2>
            <div className="grid grid-cols-3 gap-4 mt-2">
                {jobs.map(job => (
                    <JobCard key={job.id} job={job} />
                ))}
            </div>

            <h2 className="text-xl mt-6">Status Lamaran</h2>
            <ul className="mt-2">
                {applications.map(app => (
                    <li key={app.id} className="p-2 border-b">{app.job.title} - {app.status}</li>
                ))}
            </ul>
        </div>
    );
};

export default AlumniDashboard;
