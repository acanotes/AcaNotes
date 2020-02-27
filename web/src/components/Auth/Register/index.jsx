import React, { useState, useEffect } from 'react';

import { Button, Form, Input, Icon, Checkbox, message, Card } from 'antd';
import './index.less';

import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';

import { errorLogger } from 'utils';
import config from 'configuration';
import axios from 'axios';

const Register = () => {

  const { register, handleSubmit, errors, setValue, watch } = useForm();
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);
  const [registerStep, setRegisterStep] = useState("start");

  const onSubmit = (data) => {
    console.log(data);
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
      setRegisterStep("email");

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
    register({ name: 'username' }, { required: true});
    register({ name: 'first'}, { required: true });
    register({ name: 'last' });
    register({ name: 'email' }, { required: true});
    register({ name: 'password' }, { required: true, minLength: 0});
    register({ name: 'confirmPassword' },  { required: true, validate: (value) => watch('password') === value });
  }, []);

  useEffect(() => {
    console.log(errors);
    if (errors.first || errors.last || errors.email || (errors.password && errors.password.type === "required") ||
    (errors.confirmPassword && errors.confirmPassword.type === "required") || errors.username) {

      message.error("Missing required fields");
    }
    if (errors.password && errors.password.type === "minLength") {
      message.error("Password must be at least 6 characters long");
    }
    if (errors.confirmPassword && errors.confirmPassword.type === "validate") {
      message.error("Passwords do not match")
    }
  }, [errors]);

  return (
    <div className="Register">
      {registerStep === "start" &&
        <Form
          onSubmit={handleSubmit(onSubmit)}
          className="register-form"
        >
          <h2 className="register-title">Register</h2>
          <Form.Item validateStatus={errors.first && "error"}>
            <Input
              placeholder="First name"
              name="first"
              onChange={handleChange}

            />
          </Form.Item>
          <Form.Item validateStatus={errors.last && "error"}>
            <Input
              placeholder="Last name"
              name="last"
              onChange={handleChange}
            />
          </Form.Item>
          <Form.Item validateStatus={errors.username && "error"}>
            <Input
              prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
              placeholder="Username"
              name="username"
              onChange={handleChange}
            />
          </Form.Item>
          <Form.Item validateStatus={errors.email && "error"}>
            <Input
              prefix={<Icon type="mail" style={{ color: 'rgba(0,0,0,.25)' }} />}
              placeholder="Email"
              name="email"
              onChange={handleChange}
            />
          </Form.Item>
          <Form.Item validateStatus={errors.password && "error"}>
            <Input
              prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
              type="password"
              placeholder="Password"
              name="password"
              onChange={handleChange}
            />
          </Form.Item>
          <Form.Item validateStatus={errors.confirmPassword && "error"}>
            <Input
              prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
              type="password"
              placeholder="Confirm Password"
              name="confirmPassword"
              onChange={handleChange}
            />
          </Form.Item>
          <Form.Item>
            <Button type="primary" htmlType="submit" className="register-form-button">
              Register
            </Button>
          </Form.Item>
        </Form>
      }
      { registerStep === "email" &&
        <Card>
          <h2 className="success-text">Registration success! Check your email</h2>
        </Card>
      }
    </div>
  )
}

export default Register
