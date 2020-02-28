import React from 'react';
import Register from 'components/Auth/Register';
import MainLayout from 'layouts/MainLayout';

import './index.less';

const RegisterPage = () => {
  return (
    <MainLayout>
      <div className="RegisterPage">
        <div className="main-container">
          <Register />
        </div>
      </div>
    </MainLayout>
  )
}

export default RegisterPage
