import React, { useState } from 'react';
import { Menu, Icon } from 'antd';
import './index.less';
const { SubMenu } = Menu;




const Navbar = () => {
  const [menu, setMenu] = useState("mail");
  const handleClick = e => {
    setMenu(e.key);
  };
  return (
    <Menu onClick={setMenu} selectedKeys={[menu]} mode="horizontal" className="Navbar">
      <Menu.Item key="mail">
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
      <Menu.Item key="createNote">
        <Icon type="file-add" />
        Create Note
      </Menu.Item>

      <Menu.Item key="acanotes">
        <a href="https://www.acanotes.com" target="_blank" rel="noopener noreferrer">
          Some Link
        </a>
      </Menu.Item>
      <Menu.Item key="login" className="login-item">
        <Icon type="down-square" className="login-icon" />
        Login
      </Menu.Item>
    </Menu>
  )
}

export default Navbar
