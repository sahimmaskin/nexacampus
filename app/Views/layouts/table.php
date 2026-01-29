	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const searchInput = document.getElementById("tableSearch");
			const table = document.querySelector("table"); // adjust if multiple tables
			const rows = table.querySelectorAll("tbody tr");

			searchInput.addEventListener("keyup", function() {
		    	const term = this.value.toLowerCase();

		    	rows.forEach(row => {
		      		const text = row.textContent.toLowerCase();
		      		row.style.display = text.includes(term) ? "" : "none";
		    	});
		  	});
		});

		document.addEventListener("DOMContentLoaded", function() {
			const table = document.getElementById("userTable");
			const headers = table.querySelectorAll("th.sortable");

			headers.forEach((header, index) => {
    			header.addEventListener("click", () => {
					const tbody = table.querySelector("tbody");
					const rows = Array.from(tbody.querySelectorAll("tr"));

					// Determine new direction
					let asc = true;

					// If this header is already sorted ascending, switch to descending
					if (header.classList.contains("asc")) {
	        			asc = false;
	      			}

					// Remove sorting classes from all headers
					headers.forEach(h => h.classList.remove("asc", "desc"));

					// Add class for the new direction
					header.classList.add(asc ? "asc" : "desc");

					// Sort rows
	      			rows.sort((a, b) => {
						const aText = a.children[index].textContent.trim().toLowerCase();
						const bText = b.children[index].textContent.trim().toLowerCase();

						// Try numeric comparison first
						const aNum = parseFloat(aText);
						const bNum = parseFloat(bText);

						if (!isNaN(aNum) && !isNaN(bNum)) {
	          				return asc ? aNum - bNum : bNum - aNum;
	        			}

	        			return asc ? aText.localeCompare(bText) : bText.localeCompare(aText);
	      			});

	      			rows.forEach(row => tbody.appendChild(row));
	    		});
	  		});
		});
	</script>

	<style>
		th.sortable {
  			cursor: pointer;
  			position: relative;
		}

		th.sortable.asc::after {
  			content: " ▲";
  			font-size: 12px;
		}

		th.sortable.desc::after {
  			content: " ▼";
  			font-size: 12px;
		}
	</style>