<x-app-layout>
    <h3>Reporting</h3>
    <table>
        <thead>
          <tr>
            <th>Status</th>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Plate Number</th>
            <th>Email</th>
            <th>Access Level</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
            <td>1</td>
            <td>Jon Snow</td>
            <td>35</td>
            <td>(665)121-5454</td>
            <td>jonsnow@gmail.com</td>
            <td class="text-center"><!-- Add text-center class to center content -->
        <button type="button" class="btn btn-primary btn2">COMPLETE</button>
      </td>
          </tr>
          <tr>
            <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
            <td>1</td>
            <td>Jon Snow</td>
            <td>35</td>
            <td>(665)121-5454</td>
            <td>jonsnow@gmail.com</td>
            <td class="text-center"><!-- Add text-center class to center content -->
        <button type="button" class="btn btn-primary btn2">DEPLOYED</button>
      </td>
          </tr>
          <tr>
            <td><i class="fa fa-check-circle" aria-hidden="true"></i></td>
            <td>1</td>
            <td>Jon Snow</td>
            <td>35</td>
            <td>(665)121-5454</td>
            <td>jonsnow@gmail.com</td>
            <td class="text-center"><!-- Add text-center class to center content -->
        <button type="button" class="btn btn-primary btn2">UNREAD</button> 
      </td>
          </tr>
          
          
          </tbody>
      </table>


      <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Modal content goes here -->
                </div>

                <!-- Modal Footer -->
              

            </div>
        </div>
    </div>





      <div id="pagination">
        <button id="prev-button" class="icon disabled-icon" style = "margin-right: 20px">Prev</button>
        <span id="page-info" style = "margin-right: 10px"> 1-10 of 9</span>
        <button id="next-button" class="icon">Next</button>
      </div>

         
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



      <script>
        const table = document.querySelector('table');
        const tbody = table.querySelector('tbody');
        const rowsPerPage = 10; // Set rows per page
        const pageInfo = document.getElementById('page-info');
        const prevButton = document.getElementById('prev-button'); 
        const nextButton = document.getElementById('next-button');

        let currentPage = 1;
        let rows = tbody.querySelectorAll('tr');

        function showPage(page) {
          const startIndex = (page - 1) * rowsPerPage;
          const endIndex = startIndex + rowsPerPage;

          for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';
          }

          for (let i = startIndex; i < endIndex && i < rows.length; i++) {
            rows[i].style.display = '';
          }

          pageInfo.textContent = `${startIndex + 1}-${endIndex} of ${rows.length}`;

          prevButton.classList.remove('disabled-icon');
          nextButton.classList.remove('disabled-icon');

          if (page === 1) {
            prevButton.classList.add('disabled-icon');
          }

          if (page === Math.ceil(rows.length / rowsPerPage)) {
            nextButton.classList.add('disabled-icon');
          }
        }

        showPage(currentPage);

        nextButton.addEventListener('click', () => {
          if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
            currentPage++;
            showPage(currentPage);
          }
        });

        prevButton.addEventListener('click', () => {
          if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
          }
        });

             // Your existing JavaScript code

        // Add a click event listener to the buttons
        const buttons = document.querySelectorAll('.btn2');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Set the modal content here
                const modalBody = document.querySelector('.modal-body');
                modalBody.innerHTML = `<p>Button ${button.textContent} clicked!</p>`;

                // Show the modal
                $('#myModal').modal('show');
            });
        });
      </script>
  

</x-app-layout> 
