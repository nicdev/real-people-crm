
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function discardImportedContact(contactId) {
    axios.post(`/api/contacts/${contactId}/update`, {
        is_discarded: true
    });
    
    document.getElementById(`contact-${contactId}`).remove();
}
