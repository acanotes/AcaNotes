import React from 'react';
import { Button, Form, Input, Icon, Checkbox } from 'antd';
import Navbar from 'components/Navbar';

import './index.less';

const LoginPage = () => {
  return (
    <div className="LoginPage">
      <Navbar />
      <div className="main-container">

        <Form onSubmit={() => {

        }} className="login-form">
          <h2 className="login-title">Login</h2>
        <Form.Item>
          <Input
            prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
            placeholder="Username"
          />
        </Form.Item>
        <Form.Item>
          <Input
            prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
            type="password"
            placeholder="Password"
          />
        </Form.Item>
        <Form.Item>
          <Checkbox>Remember me</Checkbox>
          <a className="login-form-forgot" href="">
            Forgot password
          </a>
          <Button type="primary" htmlType="submit" className="login-form-button">
            Log in
          </Button>
          Or <a href="">register now!</a>
        </Form.Item>
      </Form>
      </div>
    </div>
  )
}

export default LoginPage
