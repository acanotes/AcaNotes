import React, { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';
import { Button, Form, Input, Icon, message } from 'antd';
import { useHistory } from "react-router-dom";
import { errorLogger } from 'utils';
import config from 'configuration';

import { updateUser } from 'actions/users';

import './index.less';

const EditUserForm = (props) => {
  console.log(props.default)
  const { register, handleSubmit, setValue, errors } = useForm();
  const initialValues = {
    first: props.default.firstName,
    last: props.default.lastName
  }
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);
  const history = useHistory();

  const [madeEdit, setMadeEdit] = useState(false);

  const onSubmit = (data) => {

    console.log(data);
    updateUser(data).then((res) => {
      message.success("Updated Profile");
    }).catch(errorLogger)
  };
  const handleChange = (e) => {
    setValue(e.target.name, e.target.value);
    setMadeEdit(true);
  };
  // register inputs
  useEffect(() => {
    register({ name: 'first'}, { required: true });
    register({ name: 'last' });
    register({ name: 'description' });
    register({ name: 'email' }, { required: true });

  }, []);

  useEffect(() => {
    console.log(errors);
    if (errors.first || errors.last || errors.email) {
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
          name="first"
          value={props.default.firstName}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.last && "error"}>
        <Input
          placeholder="Last name"
          name="last"
          value={props.default.lastName}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.email && "error"}>
        <Input
          prefix={<Icon type="mail" style={{ color: 'rgba(0,0,0,.25)' }} />}
          placeholder="Email"
          name="email"
          value={props.default.email}
          onChange={handleChange}
        />
      </Form.Item>
      <Form.Item validateStatus={errors.description && "error"}>
        <Input.TextArea
          placeholder="Description"
          name="description"
          value={props.default.description}
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
