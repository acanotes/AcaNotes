import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Avatar from 'components/User/Avatar';
import EditUserForm  from 'components/User/EditUserForm';
import { useParams } from 'react-router-dom';
import { getUser, getPopularUploads } from 'actions/users';

import UserContext from 'UserContext.js';
import { errorLogger } from 'utils';

import './index.less';

const EditProfilePage = (props) => {
  const params = useParams();
  const userHooks = React.useContext(UserContext);
  return (
    <MainLayout>
      <div className="EditProfilePage">
        <div className="main-container">
          <div className="form-wrapper">
            <h2 className="edit-title">Edit Profile</h2>
            <EditUserForm default={userHooks.user} className="edit-form"/>
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default EditProfilePage
