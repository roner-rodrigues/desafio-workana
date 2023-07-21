import React from 'react';
import { createRoot } from 'react-dom/client';
import './styles/index.css';
import LoginLayout from './LoginLayout';
import reportWebVitals from './reportWebVitals';

const root = document.getElementById('root');
if (root !== null) {
  createRoot(root).render(
    <React.StrictMode>
      <LoginLayout />
    </React.StrictMode>
  );
}

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
