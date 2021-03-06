import React, { useState, useEffect } from 'react';

import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';
import { useHistory } from "react-router-dom";

import { errorLogger, setCookie, tokenGetClaims } from 'utils';
import config from 'configuration';
import axios from 'axios';

import { Button, Form, Input, Icon, Checkbox, message } from 'antd';
import './index.less';

const Login = () => {

  const { register, handleSubmit, setValue, errors } = useForm();
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);
  const history = useHistory();
  const onSubmit = (data) => {

    console.log(data);
    axios.post(config.API_URL + config.routes.auth.login, data).then((response: any) => {
      console.log(response.data);

      const claims = tokenGetClaims(response.data.token);
      console.log(claims);
      userHooks.setUser({token:response.data.token, loggedIn: true, ...claims});
      setCookie('acanotes_alpaca_token', response.data.token, 7);
      message.success("Logged in");
      history.push("/");

    }).catch(errorLogger).finally(() => {
      setLoading(false);
    })
  };

  const handleChange = (e) => {
    setValue(e.target.name, e.target.value);
  };
  // register inputs
  useEffect(() => {
    register({ name: 'username' });
    register({ name: 'password' });
  }, []);
  return (
    <div className="Login">
      <Form
        onSubmit={handleSubmit(onSubmit)}
        className="login-form"
      >
        <h2 className="login-title">Login</h2>
        <Form.Item validateStatus={errors.username && "error"}>
          <Input
            prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
            placeholder="Username or Email"
            name="username"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item validateStatus={errors.password && "error"}>
          <Input
            prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
            type="password"
            placeholder="Password"
            onChange={handleChange}
            name="password"
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
          Or <a href="/register">register now!</a>
        </Form.Item>
      </Form>
    </div>
  )
}

export default Login
