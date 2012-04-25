function(doc) {
    if (doc.event && doc.speakers) {
        for (idx = 0; idx < doc.speakers.length; idx++) {
            if (doc.speakers[idx].last_name) {
                emit([doc.event.name, doc.speakers[idx].last_name, doc.speakers[idx].first_name, doc.speakers[idx]._id], doc.speakers[idx]);
            }
        }
    }
}
