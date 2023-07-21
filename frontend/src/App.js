import React from 'react';
import ProductList from './components/ProductListForm';
import ProductTypeList from './components/ProductTypeListForm';
import ProductForm from './components/ProductCreateForm';
import ProductTypeCreateForm from './components/ProductTypeCreateForm';
import SalePage from './pages/SalePage';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import  './styles/App.css';
import PropTypes from 'prop-types';

function App({ onLogout }) {
  return (
    <Router>
      <div className="App">
        <header className="App-header">
          <nav>
            <ul>
              <li><Link to="/create-product">Register Product</Link></li>
              <li><Link to="/create-product-type">Register Product Type</Link></li>
              <li><Link to="/product-list">List Products</Link></li>
              <li><Link to="/product-types-list">List Product Types</Link></li>
              <li><Link to="/sale">My Cart</Link></li>
              <li><button onClick={onLogout}>Logout</button></li>
            </ul>
          </nav>
          <Routes>
            <Route path="/create-product" element={<ProductForm />} />
            <Route path="/create-product-type" element={<ProductTypeCreateForm />} />
            <Route path="/product-list" element={<ProductList />} />
            <Route path="/product-types-list" element={<ProductTypeList />} />
            <Route path="/sale" element={<SalePage />} />
          </Routes>
        </header>
      </div>
    </Router>
  );
}

App.propTypes = {
  onLogout: PropTypes.func.isRequired,
};

export default App;
