import React from 'react';
import './styles/App.css';
import ProductList from './components/ProductListForm';
import ProductForm from './components/ProductCreateForm';
import ProductTypeCreateForm from './components/ProductTypeCreateForm';
import SalePage from './pages/SalePage';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';

function App() {
  return (
    <Router>
      <div className="App">
        <header className="App-header">
          <nav>
            <ul>
              <li><Link to="/create-product">Register Product</Link></li>
              <li><Link to="/create-product-type">Register Product Type</Link></li>
              <li><Link to="/product-list">List Products</Link></li>
              <li><Link to="/sale">My Cart</Link></li>
            </ul>
          </nav>
          <Routes>
            <Route path="/create-product" element={<ProductForm />} />
            <Route path="/create-product-type" element={<ProductTypeCreateForm />} />
            <Route path="/product-list" element={<ProductList />} />
            <Route path="/sale" element={<SalePage />} />
          </Routes>
        </header>
      </div>
    </Router>
  );
}

export default App;