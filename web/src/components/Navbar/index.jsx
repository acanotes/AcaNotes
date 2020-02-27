import React, { useState, useEffect } from 'react';
import { useHistory } from "react-router-dom";

import UserContext from 'UserContext';

import { Menu, Icon } from 'antd';
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
          setMenu("createNote");
        break;
      case '/register':
          setMenu("register");
        break;
      case '/login':
        setMenu("login");
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
      <SubMenu
        title={
          <span className="submenu-title-wrapper">
            <Icon type="notification" />
            What's New
          </span>
        }
      >
        <Menu.ItemGroup title="Item 1">
          <Menu.Item key="setting:1">Option 1</Menu.Item>
          <Menu.Item key="setting:2">Option 2</Menu.Item>
        </Menu.ItemGroup>
        <Menu.ItemGroup title="Item 2">
          <Menu.Item key="setting:3">Option 3</Menu.Item>
          <Menu.Item key="setting:4">Option 4</Menu.Item>
        </Menu.ItemGroup>
      </SubMenu>
      <Menu.Item key="createNote" onClick={() => history.push('#')}>
        <Icon type="file-add" />
        Create Note
      </Menu.Item>
      {userHooks.user.loggedIn ?
        <Menu.Item key="logout" className="logout-item" onClick={() => history.push('/login')}>
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
