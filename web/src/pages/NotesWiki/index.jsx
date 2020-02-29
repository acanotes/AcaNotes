import React, { useEffect, useState } from 'react';
import { Button } from 'antd';
import MainLayout from 'layouts/MainLayout';
import Header from 'components/Header';
import NotesList from 'components/Notes/NotesList';

import { getTopNotes } from 'actions/notes';

import './index.less';

const NotesWikiPage = () => {
  const [topNotes, setTopNotes] = useState(["empty"]);
  const [topNotesLoading, setLoading] = useState(true);
  useEffect(() => {
    getTopNotes(5).then((res) => {
      setTopNotes(JSON.parse(res.data.res));
      setLoading(false);
    })
  }, []);
  return (
    <MainLayout>
      <div className="NotesWikiPage">
        <Header title="Notes Wiki"/>
        <div className="main-container">
          <NotesList notes={topNotes} loading={topNotesLoading}/>
        </div>
      </div>
    </MainLayout>
  )
}

export default NotesWikiPage
