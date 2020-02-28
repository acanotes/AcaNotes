import React, { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import UserContext from 'UserContext';
import { useHistory } from "react-router-dom";
import { errorLogger, setCookie, tokenGetClaims } from 'utils';
import config from 'configuration';
import axios from 'axios';
import { Form, Checkbox, Button, Icon, Input, Select, Upload, message } from 'antd';
import { uploadNote } from 'actions/notes';

import './index.less';

const { Option, OptGroup } = Select;

const CreateNote = () => {
  const { register, handleSubmit, setValue, errors } = useForm();
  const [loading, setLoading] = useState(false);
  const userHooks = React.useContext(UserContext);
  const history = useHistory();

  const [ fileList, setFileList ] = useState([]);

  const dummyRequest = ({ file, onSuccess }) => {
    setTimeout(() => {
      onSuccess("ok");
    }, 0);
  };
  const onFileChange = (info) => {
    let fileList = [...info.fileList];
    let lastFile = fileList[fileList.length - 1];
    setFileList([lastFile]);
    console.log(lastFile);
    setValue("file", {file: lastFile});
  }
  const onSubmit = (data) => {

    console.log(data);
    uploadNote({...data, token: userHooks.token}).then(() => {

    }).catch((error) => {

    });
  };

  const handleChange = (e) => {

    setValue(e.target.name, e.target.value);
  };
  // register inputs
  useEffect(() => {
    register({ name: 'title' }, { required: true });
    register({ name: 'class' }, { required: true });
    register({ name: 'description' }, { required: true });
    register({ name: 'file'});
  }, []);
  useEffect(() => {
    if (errors.title || errors.class || errors.description) {
      message.error("Missing required fields")
    }
  }, [errors]);
  return (
    <div className="CreateNote">
      <Form
        onSubmit={handleSubmit(onSubmit)}
        className="createnote-form"
      >
        <h2 className="createnote-title">Create Notes</h2>
        <Form.Item label="Title" validateStatus={errors.title && "error"}>
          <Input
            placeholder="Title"
            name="title"
            onChange={handleChange}
          />
        </Form.Item>
        <Form.Item label="Class" validateStatus={errors.class && "error"}>
          <Select
            placeholder="Select A Class"
            name="class"
            onChange={(e) => {
              setValue("class", e);
            }}
          >
            <OptGroup label="Group 1: Language and Literature">
              <Option value="English Lang Lit">English A Lang & Lit</Option>
              <Option value="English Lit">English A Literature</Option>
              <Option value="Chinese Lang Lit">Chinese A Lang & Lit</Option>
            </OptGroup>
            <OptGroup label="Group 2: Language Acquisition">
              <Option value="Chinese B">Chinese B</Option>
              <Option value="French B">French B</Option>
              <Option value="Spanish B">Spanish B</Option>
              <Option value="English B">English B</Option>
              <Option value="Chinese AB">Chinese AB initio</Option>
              <Option value="French AB">French AB initio</Option>
              <Option value="Spanish AB">Spanish AB initio</Option>
            </OptGroup>
            <OptGroup label="Group 3: Individuals and Societies">
              <Option value="Economics">Economics</Option>
              <Option value="Geography">Geography</Option>
              <Option value="Global Politics">Global Politics</Option>
              <Option value="History">History</Option>
              <Option value="Psychology">Psychology</Option>
              <Option value="ITGS">ITGS</Option>
              <Option value="Business and Mgmt">Business and Management</Option>
              <Option value="Philosophy">Philosophy</Option>
            </OptGroup>
            <OptGroup label="Group 4: Sciences">
              <Option value="Physics">Physics</Option>
              <Option value="Chemistry">Chemistry</Option>
              <Option value="Biology">Biology</Option>
              <Option value="ESS">Environmental Science</Option>
              <Option value="Sports Science">Sports Science</Option>
            </OptGroup>
            <OptGroup label="Group 5: Mathematics">
              <Option value="Math">Math</Option>
              <Option value="Computer Science">Computer Science</Option>
              <Option value="Math Studies">Math Studies</Option>
            </OptGroup>
            <OptGroup label="Group 6: Arts">
              <Option value="Film">Film</Option>
              <Option value="Music">Music</Option>
              <Option value="Theatre">Theatre</Option>
              <Option value="Visual Arts">Visual Arts</Option>
            </OptGroup>
            <OptGroup label="Other">
              <Option value="Other">Other</Option>
            </OptGroup>
          </Select>
        </Form.Item>
        <Form.Item label="Description" validateStatus={errors.description && "error"}>
          <Input.TextArea
            name="description"
            placeholder="Description"
            onChange={handleChange}
          >
          </Input.TextArea>
        </Form.Item>
        <Form.Item validateStatus={errors.file && "error"}>
          <Upload name="file" type="file" customRequest={dummyRequest} fileList={fileList} onChange={onFileChange}>
            <Button>
              Click to Upload
            </Button>
          </Upload>
        </Form.Item>
        <Form.Item>
          <Button type="primary" htmlType="submit" className="createnote-button">
            Create
          </Button>
        </Form.Item>
      </Form>
    </div>
  )
}

export default CreateNote
