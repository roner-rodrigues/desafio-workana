import React, { useState } from 'react';
import axios from 'axios';
import LoginForm from './LoginForm';
import App from './App';

function LoginLayout() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  const login = async (username, password) => {
    try {
      const response = await axios.post('http://localhost:8080/login.php', { username, password });
  
      if (response.status === 200) {
        setIsLoggedIn(true);
      } else {
        setIsLoggedIn(false);
        alert('Invalid username or password');
      }
    } catch (error) {
      setIsLoggedIn(false);
      alert('Login request failed');
    }
  };
  

  if (isLoggedIn) {
    return <App onLogout={() => setIsLoggedIn(false)} />;
  } else {
    return <LoginForm onLogin={login} />;
  }
}

export default LoginLayout;
