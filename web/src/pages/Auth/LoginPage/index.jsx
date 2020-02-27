import React from 'react';

import Navbar from 'components/Navbar';
import Login from 'components/Auth/Login';

import './index.less';

const LoginPage = () => {
  return (
    <div className="LoginPage">
      <Navbar />
      <div className="main-container">
        <Login />
      </div>
    </div>
  )
}

export default LoginPage
