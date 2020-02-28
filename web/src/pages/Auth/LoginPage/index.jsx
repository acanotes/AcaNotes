import React from 'react';
import Login from 'components/Auth/Login';
import MainLayout from 'layouts/MainLayout';
import './index.less';

const LoginPage = () => {
  return (
    <MainLayout>
      <div className="LoginPage">
        <div className="main-container">
          <Login />
        </div>
      </div>
    </MainLayout>
  )
}

export default LoginPage
