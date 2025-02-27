import React, { useState } from 'react';
import { register } from '../../services/api';
import { useNavigate } from 'react-router-dom';

const Register = () => {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        password: '',
        role: 'alumni',
        nim: ''
    });
    const [error, setError] = useState(null);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await register(formData);
            navigate('/login');
        } catch (err) {
            setError('Registrasi gagal. Pastikan data yang Anda masukkan benar.');
        }
    };

    return (
        <div className="flex items-center justify-center h-screen">
            <div className="w-96 p-6 bg-white shadow-lg rounded-lg">
                <h2 className="text-2xl font-bold text-center">Register</h2>
                {error && <p className="text-red-500">{error}</p>}
                <form onSubmit={handleSubmit}>
                    <div>
                        <label>Nama</label>
                        <input
                            type="text"
                            className="w-full p-2 border rounded"
                            name="name"
                            value={formData.name}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div>
                        <label>Email</label>
                        <input
                            type="email"
                            className="w-full p-2 border rounded"
                            name="email"
                            value={formData.email}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div>
                        <label>NIM</label>
                        <input
                            type="text"
                            className="w-full p-2 border rounded"
                            name="nim"
                            value={formData.nim}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mt-3">
                        <label>Password</label>
                        <input
                            type="password"
                            className="w-full p-2 border rounded"
                            name="password"
                            value={formData.password}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <button type="submit" className="w-full mt-4 bg-green-500 text-white p-2 rounded">
                        Register
                    </button>
                </form>
            </div>
        </div>
    );
};

export default Register;
