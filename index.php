<?php
include("db.php");

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
	<main>
		<!-- Cards -->
		<div class="container pt-5">
			<h3 class="w600">Books</h3>
			<!-- Add the loading message div -->
			<div id="loading_message" style="display: none; color: blue;">Generating report...</div>
			<!-- Modify the button to call the JavaScript function -->
			<button id="generate_report_btn" class="btn btn-primary my-4 px-3" onclick="generateReport()">Generate
				Report</button>
			<table class="table table-bordered mt-4">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">ISBN</th>
						<th scope="col">Title</th>
						<th scope="col">Availability</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>

					<?php $count = 1;
					while ($book = mysqli_fetch_assoc($result)) { ?>

						<tr>
							<th class="align-middle" scope="row"><?php echo $count; ?></th>
							<td class="align-middle"><?php echo $book['isbn']; ?></td>
							<td class="align-middle"><?php echo $book['title']; ?></td>
							<?php if ($book['availability'] == 1) {
								echo "<td class='align-middle'><span class='badge text-bg-success'>Available</span></td>";
							} else {
								echo "<td class='align-middle'><span class='badge text-bg-warning'>Not Available</span></td>";
							}
							?>

							<td>
								<div class="d-flex flex-row">
									<a href="" class="btn btn-primary me-2"><i class="bi bi-eye"></i></a>
									<a href="" class="btn btn-danger me-2"><i class="bi bi-trash"></i></a>
									<?php if ($book['availability'] == 1) {
										echo "<a href='' class='btn btn-success'><i class='bi bi-box-arrow-in-up'></i></a>";
									} else {
										echo "<a href='' class='btn btn-warning'><i class='bi bi-box-arrow-in-down'></i></a>";
									}
									?>
								</div>
							</td>
						</tr>

					<?php $count++;
					} ?>

				</tbody>
			</table>

		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		function generateReport() {
			// Show the loading message
			$('#loading_message').show();

			//disable generate report button
			$('#generate_report_btn').prop('disabled', true);

			// Use Ajax to call your PHP script that generates the report
			// For demonstration purposes, we'll use a setTimeout to simulate a delay of 5 seconds (replace this with your actual code)
			$.ajax({
				url: 'Report.php', // Replace with the actual URL of your PHP script that generates the report
				type: 'POST',
				data: {
					/* Any data you need to pass to your PHP script */
				},
				success: function(data) {
					// Report generation is complete, hide the loading message
					$('#loading_message').hide();
					// Here you can do something with the generated report data, if needed

					//disable generate report button
					$('#generate_report_btn').prop('disabled', false);

					downloadPDF();

				},
				error: function(xhr, status, error) {
					// Handle error if the report generation fails
					$('#loading_message').hide();
					console.error(error);
				}
			});
		}

		function downloadPDF() {
			// Replace 'path/to/your/pdf/file.pdf' with the actual path to your PDF file
			const filePath = 'vendor/geekcom/phpjasper/bin/jasperstarter/bin/output/books.pdf';

			// Create an anchor element
			const anchor = document.createElement('a');
			anchor.href = filePath;
			anchor.target = '_blank'; // Open the link in a new tab
			anchor.download = 'Books Report.pdf'; // Specify the desired filename for the downloaded file

			// Programmatically click on the anchor element to trigger the download
			anchor.click();
		}

		// Attach the downloadPDF function to the click event of the button
		const downloadBtn = document.getElementById('downloadBtn');
		downloadBtn.addEventListener('click', downloadPDF);
	</script>
</body>

</html>