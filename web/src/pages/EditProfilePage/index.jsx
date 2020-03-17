import React, { useEffect, useState, useRef } from 'react';
import { Button, Upload, Modal } from 'antd';
import { UploadOutlined } from '@ant-design/icons'
import MainLayout from 'layouts/MainLayout';
import Avatar from 'components/User/Avatar';
import EditUserForm  from 'components/User/EditUserForm';
import { useParams } from 'react-router-dom';
import { uploadUserImage } from 'actions/users';

import UserContext from 'UserContext.js';
import { errorLogger } from 'utils';

import './index.less';

const EditProfilePage = (props) => {
  const params = useParams();
  const userHooks = React.useContext(UserContext);

  const [ bg, setBG ] = useState("");
  const [ fileList, setFileList ] = useState([]);
  const [ visible, setVisible ] = useState(false);
  const [ uploadState, setUploadState ] = useState("none");
  const dummyRequest = ({ file, onSuccess }) => {
    setTimeout(() => {
      onSuccess("ok");
    }, 0);
  };
  const onFileChange = (info) => {
    let fileList = [...info.fileList];
    URL.revokeObjectURL(bg);
    if (fileList.length) {
      let lastFile = fileList[fileList.length - 1];
      if (lastFile) {
        setFileList([lastFile]);
      }
      let newBg = URL.createObjectURL(lastFile.originFileObj);
      console.log(newBg);
      setBG(newBg);
      console.log(lastFile);
    }
    else {
      setBG("");
    }

  }
  const handleCancel = () => {
    setVisible(false);
    setUploadState("none");
  }
  const showModal = () => {
    setVisible(true);
    console.log(uploadImageButton);
  }
  const uploadPhoto = () => {
    console.log("Uploading...");
    setUploadState("uploading");
    uploadUserImage(userHooks.user, fileList[0].originFileObj).then((res) => {
      setUploadState("none");
      setVisible(false);
    }).catch((error) => {
      setUploadState("none");
    })
  }
  const uploadImageButton = useRef(null);
  return (
    <MainLayout>
      <div className="EditProfilePage">

        <div className="main-container">
          <div className="form-wrapper">
            <h2 className="edit-title">Edit Profile</h2>
            <Avatar size="large" background={bg} className="avatar"/>

              <Button type="primary" className="upload-modal-button" onClick={showModal}>
                Change Profile Picture
              </Button>
              <Modal
                visible={visible}
                title="Change Profile Picture"
                onOk={uploadPhoto}
                onCancel={handleCancel}
                className="EditProfilePage-Modal"
                footer={[
                  <Button key="back" onClick={handleCancel}>
                    Return
                  </Button>,
                  <Button key="submit" type="primary" loading={uploadState === "uploading"} onClick={uploadPhoto} disabled={fileList.length == 0}>
                    {uploadState !== "uploading" && <UploadOutlined />} Upload
                  </Button>,
                ]}
              >
                <div className="upload-wrapper">
                  <Upload className="upload-profile-pic" name="file" type="file" customRequest={dummyRequest} fileList={fileList} onChange={onFileChange}
                    onRemove={
                      () => {
                        setFileList([]);
                      }
                    }
                  >
                    <div className="new-profile-pic-wrapper">
                      <Avatar size="large" background={bg} className="avatar"/>
                    </div>
                    <Button className="upload-button" innerRef={uploadImageButton}>
                      Change Picture
                    </Button>
                  </Upload>
                </div>
              </Modal>

            <EditUserForm default={userHooks.user} className="edit-form"/>
          </div>
        </div>
      </div>
    </MainLayout>
  )
}

export default EditProfilePage
