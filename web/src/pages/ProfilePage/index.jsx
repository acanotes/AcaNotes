import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';

import { getUser } from 'actions/users';

import UserContext from 'UserContext.js';
import { errorLogger } from 'utils';

import './index.less';

const ProfilePage = () => {
  const userHooks = React.useContext(UserContext);
  const [userData, setUser] = useState({});
  useEffect(() => {
    getUser(userHooks.user.username).then((res) => {
      setUser(res);
    }).catch((error) => {
      errorLogger(error);
    })
  }, []);
  return (
    <MainLayout>
      <div className="ProfilePage">
        <div className="main-container">
        <h1>Acanotes</h1>
        </div>
      </div>
    </MainLayout>
  )
}

export default ProfilePage
