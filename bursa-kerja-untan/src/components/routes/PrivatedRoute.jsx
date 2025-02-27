import { Navigate, Outlet } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

const PrivateRoute = ({ allowedRoles }) => {
    const { user, loading } = useAuth();

    if (loading) return <p>Loading...</p>;

    if (!user) return <Navigate to="/auth/login" />;

    if (!allowedRoles.includes(user.role)) return <Navigate to="/" />;

    return <Outlet />;
};

export default PrivateRoute;
