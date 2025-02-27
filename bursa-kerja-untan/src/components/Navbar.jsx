import { useAuth } from "../context/AuthContext";
import { api } from "../services/api";
import { useNavigate } from "react-router-dom";

const Navbar = () => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await api.post("/logout");
    logout();
    navigate("/login");
  };

  return (
    <nav>
      <h1>Bursa Kerja UNTAN</h1>
      {user ? (
        <button onClick={handleLogout}>Logout</button>
      ) : (
        <a href="/login">Login</a>
      )}
    </nav>
  );
};

export default Navbar;
