import React, { useState, useEffect } from 'react';
import { useHistory } from "react-router-dom";

import UserContext from 'UserContext';

import { Menu, Icon } from 'antd';
import { MessageOutlined } from '@ant-design/icons';
import './index.less';
const { SubMenu } = Menu;




const Navbar = () => {
  const [menu, setMenu] = useState("");
  const history = useHistory();
  const userHooks = React.useContext(UserContext);
  useEffect(() => {
    // console.log(history.location.pathname);
    switch (history.location.pathname) {
      case '/':
        setMenu("home");
        break;
      case '/create':
          setMenu("create");
        break;
      case '/register':
          setMenu("register");
        break;
      case '/login':
        setMenu("login");
        break;
      case '/today':
        setMenu("today");
        break;
      case '/notes-wiki':
          setMenu("notes-wiki");
          break;
      default:
        setMenu("home");
    }
  // eslint-disable-next-line
  }, []);
  return (
    <Menu onClick={setMenu} selectedKeys={[menu]} mode="horizontal" className="Navbar">
      <Menu.Item key="home" onClick={() => history.push('/')}>
        <Icon type="home" />
        Home
      </Menu.Item>
      <Menu.Item key="today" onClick={() => history.push("/today")}>
        <Icon type="notification" />
        What's New
      </Menu.Item>
      <Menu.Item key="create" onClick={() => history.push('/create')}>
        <Icon type="file-add" />
        Create Note
      </Menu.Item>
      <Menu.Item key="notes-wiki" onClick={() => history.push('/notes-wiki')}>
        <MessageOutlined />
        Notes Wiki
      </Menu.Item>
      {userHooks.user.loggedIn ?
        <Menu.Item key="logout" className="logout-item" onClick={() => {
          userHooks.logout();
          history.push('/');
        }}>
          <Icon type="down-square" className="logout-icon" />
          Logout
        </Menu.Item>
        :
        [<Menu.Item key="login" className="login-item" onClick={() => history.push('/login')}>
          <Icon type="down-square" className="login-icon" />
          Login
        </Menu.Item>,
        <Menu.Item key="register" className="register-item" onClick={() => history.push('/register')}>
          <Icon type="down-square" className="register-icon" />
          Register
        </Menu.Item>]
      }

    </Menu>
  )
}

export default Navbar
