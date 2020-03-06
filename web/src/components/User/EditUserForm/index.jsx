import React, { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';
import { Button, Form, Input, Icon, message } from 'antd';
import { useHistory } from "react-router-dom";
import { errorLogger, setCookie, tokenGetClaims } from 'utils';
import config from 'configuration';

import { updateUser } from 'actions/users';

import './index.less';

const EditUserForm = (props) => {
  const { register, handleSubmit, setValue, errors } = useForm();
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);
  const history = useHistory();

  const [madeEdit, setMadeEdit] = useState(false);

  const onSubmit = (data) => {
    updateUser({...data, username: userHooks.user.username}).then((token) => {
      message.success("Updated Profile");
      const claims = tokenGetClaims(token);
      userHooks.setUser({token:token, loggedIn: true, ...claims});
      setCookie('acanotes_alpaca_token', token, 7);
    }).catch(errorLogger)
  };
  const handleChange = (e) => {
    setValue(e.target.name, e.target.value);
    setMadeEdit(true);
  };
  // register inputs
  useEffect(() => {
    register({ name: 'firstName'}, { required: true });
    register({ name: 'lastName' });
    register({ name: 'description' });
    register({ name: 'email' }, { required: true });
    for (let key in userHooks.user) {
      setValue(key, userHooks.user[key]);
    }
  }, []);

  useEffect(() => {
    console.log(errors);
    if (errors.firstName || errors.lastName || errors.email) {
      message.error("Fields can't be empty");
    }
  }, [errors]);

  return (
    <Form
      onSubmit={handleSubmit(onSubmit)}
      className={"EditUserForm " + props.className}
      name="EditUser"
    >
      <Form.Item validateStatus={errors.first && "error"}>
        <Input
          placeholder="First name"
          name="firstName"
          defaultValue={userHooks.user.firstName}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.last && "error"}>
        <Input
          placeholder="Last name"
          name="lastName"
          defaultValue={userHooks.user.lastName}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.email && "error"}>
        <Input
          prefix={<Icon type="mail" style={{ color: 'rgba(0,0,0,.25)' }} />}
          placeholder="Email"
          name="email"
          defaultValue={userHooks.user.email}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.description && "error"}>
        <Input.TextArea
          placeholder="Description"
          name="description"
          defaultValue={userHooks.user.description}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item>
        <Button type="primary" htmlType="submit" className="update-form-button">
          Update Profile
        </Button>
      </Form.Item>
    </Form>
  )
}

export default EditUserForm
