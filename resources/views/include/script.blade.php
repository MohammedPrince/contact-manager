<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function validatePhoneNumber(input) {
        var maxLength = 13;
        var inputValue = input.value.trim();
        if (!/^\+\d+$/.test(inputValue) || inputValue.length > maxLength) {
            document.getElementById('phone-error').style.display = 'block';
            input.setCustomValidity(
                "Please enter a valid phone number.");
        } else {
            document.getElementById('phone-error').style.display = 'none';
            input.setCustomValidity('');
        }
    }

    function validateContactName() {
        document.getElementById('name').addEventListener('input', function() {
            var nameInput = this.value;
            var nameRegex = /^[A-Za-z\s]+$/;

            if (nameInput.length < 4 || !nameRegex.test(nameInput)) {
                document.getElementById('name-error').style.display = 'block';
                this.setCustomValidity("Please enter a valid name with at least 4 characters and no numbers.");
            } else {
                document.getElementById('name-error').style.display = 'none';
                this.setCustomValidity("");
            }
        });
    }

    function confirmDelete(element) {
        var recordId = element.getAttribute('data-id');

        if (confirm("Are you sure you want to delete this RECORD ?")) {
            deleteRecord(recordId);
        }
    }

    function deleteRecord(recordId) {
        fetch("{{ URL::to('/delete') }}/" + recordId, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Contact deleted successfully');
                    window.location.href = "{{ route('home') }}";
                } else {
                    console.error('Failed to delete contact');
                    window.location.href = "{{ route('home') }}";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
