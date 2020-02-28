import React from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import CreateNote from 'components/CreateNote';
import './index.less';

const CreatePage = () => {
  return (
    <MainLayout>
      <div className="CreatePage">
        <div className="main-container">
          <CreateNote />
        </div>
      </div>
    </MainLayout>
  )
}

export default CreatePage
