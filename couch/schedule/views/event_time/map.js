function(doc) {
    if (doc.event && doc.time_period) {
        if (doc.space) {
            emit([doc.event.name, doc.time_period.start, doc.space.name], doc);
        } else {
            emit([doc.event.name, doc.time_period.start], doc);            
        }
    }
}
