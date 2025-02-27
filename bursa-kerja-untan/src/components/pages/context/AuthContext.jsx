import React, { createContext, useState, useEffect } from 'react';
import { getUser, login, logout } from '../services/api';
import { useNavigate } from 'react-router-dom';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        getUser()
            .then(data => setUser(data))
            .catch(() => setUser(null));
    }, []);

    const handleLogin = async (email, password) => {
        const data = await login(email, password);
        setUser(data.user);
        navigate(`/dashboard/${data.user.role}`);
    };

    const handleLogout = async () => {
        await logout();
        setUser(null);
        navigate('/login');
    };

    return (
        <AuthContext.Provider value={{ user, handleLogin, handleLogout }}>
            {children}
        </AuthContext.Provider>
    );
};
