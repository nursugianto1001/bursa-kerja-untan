import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';

const api = axios.create({
    baseURL: API_URL,
    headers: { 'Content-Type': 'application/json' },
    withCredentials: true
});

// Fungsi untuk mendapatkan statistik dashboard berdasarkan peran pengguna (admin/alumni/company)
export const getDashboardStats = async (role) => {
    try {
        const response = await api.get(`/dashboard/${role}`);
        return response.data;
    } catch (error) {
        console.error('Error fetching dashboard stats:', error.response?.data || error.message);
        throw error;
    }
};

// Fungsi untuk dashboard Alumni (lowongan & aplikasi)
export const getAlumniDashboard = async () => {
    try {
        const response = await api.get('/dashboard/alumni');
        return response.data;
    } catch (error) {
        console.error('Error fetching alumni dashboard:', error.response?.data || error.message);
        throw error;
    }
};

// Fungsi untuk dashboard Perusahaan
export const getCompanyDashboard = async () => {
    try {
        const response = await api.get('/dashboard/company');
        return response.data;
    } catch (error) {
        console.error('Error fetching company dashboard:', error.response?.data || error.message);
        throw error;
    }
};

// Login
export const login = async (email, password) => {
    try {
        const response = await api.post('/login', { email, password });
        return response.data;
    } catch (error) {
        console.error('Login error:', error.response?.data || error.message);
        throw error;
    }
};

// Register
export const register = async (userData) => {
    try {
        const response = await api.post('/register', userData);
        return response.data;
    } catch (error) {
        console.error('Register error:', error.response?.data || error.message);
        throw error;
    }
};

// Logout
export const logout = async () => {
    try {
        await api.post('/logout');
    } catch (error) {
        console.error('Logout error:', error.response?.data || error.message);
        throw error;
    }
};

// Ambil data user yang sedang login
export const getUser = async () => {
    try {
        const response = await api.get('/me');  // <--- Pastikan ini sesuai dengan backend Laravel 11
        return response.data;
    } catch (error) {
        console.error('Error fetching user data:', error.response?.data || error.message);
        throw error;
    }
};
