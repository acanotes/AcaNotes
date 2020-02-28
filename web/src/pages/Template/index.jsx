import React from 'react';
import { Button } from 'antd';
import Navbar from 'components/Navbar';
import MainLayout from 'layouts/MainLayout';

import './index.less';

const TemplatePage = () => {
  return (
    <MainLayout>
      <div className="TemplatePage">
        <div className="main-container">
        <h1>Acanotes</h1>
      </div>
    </MainLayout>
  )
}

export default TemplatePage
