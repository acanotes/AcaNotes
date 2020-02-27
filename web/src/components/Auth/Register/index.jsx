import React, { useState, useEffect } from 'react';

import { Button, Form, Input, Icon, Checkbox, message } from 'antd';
import './index.less';

import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';

import { errorLogger } from 'utils';
import config from 'configuration';
import axios from 'axios';

const Register = () => {

  const { register, handleSubmit, setValue } = useForm();
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);

  const onSubmit = (data) => {
    if (!data.username) {
      message.error('Missing username or email');
      return;
    }
    if (!data.password) {
      message.error('Missing password');
    }
    // console.log(data);
    // Add your axios stuff here
    // data.email, data.password
    console.log(data);
    axios.post(config.API_URL + config.routes.auth.register, data).then((response: any) => {
      console.log(response.data);
      let user = response.data.user;

    }).catch(errorLogger).finally(() => {
      setLoading(false);
    })
  };

  const handleChange = (e) => {
    setValue(e.target.name, e.target.value);
  };
  // register inputs
  useEffect(() => {
    console.log(process.env)
    register({ name: 'username' });
    register({ name: 'email' });
    register({ name: 'password' });
  }, []);

  return (
    <div className="Register">
      <Form
        onSubmit={handleSubmit(onSubmit)}
        className="register-form"
      >
        <h2 className="register-title">Register</h2>
        <Form.Item>
          <Input
            prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
            placeholder="Username"
            name="username"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item>
          <Input
            prefix={<Icon type="mail" style={{ color: 'rgba(0,0,0,.25)' }} />}
            placeholder="Username"
            name="email"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item>
          <Input
            prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
            type="password"
            placeholder="Password"
            name="password"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item>
          <Input
            prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
            type="password"
            placeholder="Confirm Password"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item>
          <Button type="primary" htmlType="submit" className="register-form-button">
            Register
          </Button>
        </Form.Item>
      </Form>
    </div>
  )
}

export default Register
