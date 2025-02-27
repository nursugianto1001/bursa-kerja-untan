import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import PrivateRoute from './routes/PrivateRoute';

import Login from './pages/auth/Login';
import Register from './pages/auth/Register';
import AdminDashboard from './pages/dashboard/admin/AdminDashboard';
import AlumniDashboard from './pages/dashboard/alumni/AlumniDashboard';
import CompanyDashboard from './pages/dashboard/company/CompanyDashboard';

function App() {
    return (
        <AuthProvider>
            <Router>
                <Routes>
                    <Route path="/login" element={<Login />} />
                    <Route path="/register" element={<Register />} />

                    <Route element={<PrivateRoute allowedRoles={['admin']} />}>
                        <Route path="/dashboard/admin" element={<AdminDashboard />} />
                    </Route>
                    <Route element={<PrivateRoute allowedRoles={['alumni']} />}>
                        <Route path="/dashboard/alumni" element={<AlumniDashboard />} />
                    </Route>
                    <Route element={<PrivateRoute allowedRoles={['company']} />}>
                        <Route path="/dashboard/company" element={<CompanyDashboard />} />
                    </Route>
                </Routes>
            </Router>
        </AuthProvider>
    );
}

export default App;
