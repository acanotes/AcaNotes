import React from 'react';

import Navbar from 'components/Navbar';
import Register from 'components/Auth/Register';

import './index.less';

const RegisterPage = () => {
  return (
    <div className="RegisterPage">
      <Navbar />
      <div className="main-container">
        <Register />
      </div>
    </div>
  )
}

export default RegisterPage
