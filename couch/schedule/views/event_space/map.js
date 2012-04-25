function(doc) {
    if (doc.event && doc.space && doc.time_period) {
        emit([doc.event.name, doc.space.name, doc.time_period.start], doc);
    }
}
