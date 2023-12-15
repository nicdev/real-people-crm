
function discardImportedContact(contactId) {
    axios.post(`/api/contacts/${contactId}/update`, {
        is_discarded: true
    });
    
    document.getElementById(`contact-${contactId}`).remove();
}
