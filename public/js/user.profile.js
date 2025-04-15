 // Upload image preview
 document.getElementById("profileUpload").addEventListener("change", function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("profilePicPreview");
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
