function process(event) {
	const btn = event.target;

	btn.disabled = true;

	btn.innerHTML = `
      <svg class="motion-safe:animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      `;
}

/**
 * Slash key listener ,to focus inputs
 */
document.addEventListener("keydown", (event) => {
	if (event.key === "/" && event.code === "Slash") {
		event.preventDefault();
		// var globalForm = document.getElementById("global-search");
		document.getElementById("global-search").focus();
	}
});

/**
 * dari nanamnya taulah
 */
function showPreview(event) {
	if (event.target.files.length > 0) {
		let src = URL.createObjectURL(event.target.files[0]);
		let preview = document.getElementById("imgPreview");
		preview.src = src;
	}
}

/**
 * Hapus user lain oleh admin
 */
const targetDelete = document.querySelectorAll(".deleteA");
const formDel = document.querySelector("#dxz");
targetDelete.forEach((target) => {
	target.addEventListener("click", () => {
		const namaAkun = document.querySelector("#target-acc");
		let idTarget = target.getAttribute("data-user");
		let nmTarget = target.getAttribute("data-acc");

		formDel.action = `users/hapus/${idTarget}`;
		namaAkun.textContent = nmTarget;
	});
});

/**
 * Verify user oleh admin
 */
const targetVerify = document.querySelectorAll(".verifyA");
const formVer = document.querySelector("#form");
targetVerify.forEach((target) => {
	target.addEventListener("click", () => {
		const namaAkun = document.querySelector("#target-accv");
		let idTarget = target.getAttribute("data-user");
		let nmTarget = target.getAttribute("data-acc");

		formVer.action = `users/verified/${idTarget}`;
		namaAkun.textContent = nmTarget;
	});
});

/**
 * Right Click by Ian
 */
const cards = document.querySelectorAll(".card-file");
const bSalin = document.querySelector("#rcCopy");
const form = document.querySelector("#formShareFile");
const dropdown = document.querySelector(`#dropdown`);
const downlaod = document.querySelector("#download");
const edit = document.querySelector(`#edit`);
const fileShareName = form && form.querySelector(".fileshrnm");
let countResult;
let visibleDropdown = null;
let id_file;
let file_name;

function hideDropdown() {
	if (visibleDropdown) {
		visibleDropdown.classList.add("hidden");
		visibleDropdown = null;
	}
}
function hiddenDropdownResult() {
	if (countResult) {
		result.classList.add("hidden");
		visibleDropdown = null;
	}
}

function hideDropdownUserIndex(param) {
	const dpdwn = document.querySelectorAll(param);
	dpdwn.forEach((m) => {
		m.classList.add("hidden");
	});
}

window.addEventListener("contextmenu", (e) => {
	e.preventDefault();
	return false;
});

document.addEventListener("click", (e) => {
	if (visibleDropdown && !visibleDropdown.contains(e.target)) {
		hideDropdown();
	}
	if (countResult && !result.contains(e.target)) {
		hiddenDropdownResult();
	}
});

/**
 * ESC key listener ,to hide the dropdown
 */
document.addEventListener("keydown", (event) => {
	if (event.key === "Escape") {
		//if esc key was not pressed in combination with ctrl or alt or shift
		const isNotCombinedKey = !(event.ctrlKey || event.altKey || event.shiftKey);
		if (isNotCombinedKey) {
			hideDropdown(); // https://stackoverflow.com/a/64446856
		}
	}
});

const file_name_by_click = document.querySelectorAll("[data-modal-byclick]");
file_name_by_click.forEach((f) => {
	f.addEventListener("click", () => {
		file_name = f.previousElementSibling.textContent;
		fileShareName.textContent = file_name;
	});
});

cards.forEach((c) => {
	c.addEventListener("contextmenu", (e) => {
		hideDropdownUserIndex(".dropdownUserIndex");
		hideDropdown();

		if (visibleDropdown && visibleDropdown != dropdown) {
			hideDropdown();
		}

		id_file = c.getAttribute("data-id_file");
		file_name = c.querySelector("a").textContent;
		fileShareName.textContent = file_name;

		dropdown.style.left = `${e.clientX}px`;
		dropdown.style.top = `${e.clientY}px`;
		dropdown.classList.toggle("hidden");

		downlaod.href = `/download/${id_file}`;
		edit.href = `/file/${id_file}/edit`;
		form.action = `/file/send/${id_file}`;
		document.querySelector("#formDeleteFile").action = "/file/" + id_file;
		visibleDropdown = dropdown;
		e.preventDefault();
		return false;
	});
});

/**
 * Nyalin link lewar klik kanan button
 */
bSalin &&
	bSalin.addEventListener("click", () => {
		const link = document.querySelector(`#link[data-id_file="${id_file}"]`);
		navigator.clipboard.writeText(link.value);
		alert(`Link file #${id_file} berhasil disalin!`);
	});

/**
 * Hide Modal Notif
 */
const modalNotif = document.querySelector(`#notif`);
const triggerCloseModalNotif = document.querySelector(`#closeModalNotif`);
if (triggerCloseModalNotif != null) {
	triggerCloseModalNotif.addEventListener("click", () =>
		modalNotif.classList.add("hidden")
	);
}

/**
 * Salin URL File
 */
const buttonSalinUrl = document.querySelectorAll("#salin");
buttonSalinUrl.forEach((b) => {
	b.addEventListener("click", () => {
		const id_file = b.getAttribute("data-id_file");
		const linkUrl = document.querySelector(`#link[data-id_file="${id_file}"]`);
		navigator.clipboard.writeText(linkUrl.value);
		alert(`Link file id #${id_file} berhasil disalin!`);
	});
});

/**
 * Delete File
 */
const buttonShowModalDelete = document.querySelectorAll(
	"#buttonShowModalDelete"
);
buttonShowModalDelete.forEach((b) => {
	b.addEventListener("click", () => {
		hideDropdownUserIndex(".dropdownUserIndex");
		const id_file = b.getAttribute("data-id_file");
		const form = document.querySelector(`#formDeleteFile`);
		form.action = `file/${id_file}`;
	});
});

/**
 * Modal Share Another User
 */
const buttonShowModalShare = document.querySelectorAll("#buttonShowModalShare");
buttonShowModalShare.forEach((b) => {
	b.addEventListener("click", () => {
		const modalShareAnotherUser = document
			.querySelector("#modalShareAnotherUser")
			.classList.add("hidden");
		const id_file = b.getAttribute("data-id_file");
		hideDropdownUserIndex(".dropdownUserIndex");
		form.action = "";
		form.action = "file/send/" + id_file;
	});
});

/**
 * Kalau pas search nama user klik diluar elemnt daftar nama user
 */
const areaResultUser = document.querySelector("#result");
areaResultUser &&
	document.addEventListener("click", function (event) {
		// Periksa apakah klik dilakukan di luar elemen result
		if (!areaResultUser.contains(event.target)) {
			// Jika ya, tambahkan class hidden pada elemen result
			areaResultUser.classList.add("hidden");
		}
	});
// Event listener untuk menampilkan kembali elemen result jika diklik
areaResultUser &&
	areaResultUser.addEventListener("click", function (event) {
		// Hapus class hidden saat elemen result diklik
		areaResultUser.classList.remove("hidden");
	});

/**
 * Deklarasi variable
 */
const result = document.querySelector("#result");
const textAreaPesan = document.querySelector("#pesan");
const buttonModalShare = document.querySelectorAll("#bSearch");
const searchUser = document.querySelector("#searchUser");
const notfon = document.querySelector("#notfon");
const btnSendFile = document.querySelector("#sendFile");
let clicked = false;
let username;

textAreaPesan &&
	textAreaPesan.addEventListener("focus", () => {
		result.classList.add("hidden");
		searchUser.classList.add("rounded-lg");
		searchUser.classList.remove("rounded-t-lg");
	});

btnSendFile &&
	btnSendFile.addEventListener("click", () => {
		btnSendFile.disabled = true;
	});

searchUser &&
	searchUser.addEventListener("input", () => {
		let valueSearch = searchUser.value.trim();
		if (valueSearch != "") {
			result.innerHTML =
				"<span class='block px-4 py-2'>Fetching users...</span>";
			const { userPromise } = fetch(`/username?q=${valueSearch}`, {
				method: "GET",
				headers: {
					"Content-Type": "application/json",
				},
			})
				.then((response) => {
					return response.json();
				})
				.then((dataUsers) => {
					const users = dataUsers.dataUsers;
					result.innerHTML = "";
					searchUser.addEventListener("keyup", function () {
						clicked = false;
						btnSendFile.disabled = true;
					});

					if (users.length == 0) {
						searchUser.classList.add("rounded-lg");
						searchUser.classList.remove("rounded-t-lg");
						result.classList.add("hidden");
						notfon.textContent = `User '${valueSearch}' tidak ada!`;
						notfon.classList.remove("hidden");
						notfon.classList.add("block");
						btnSendFile.disabled = true;
					} else {
						searchUser.classList.remove("rounded-lg");
						searchUser.classList.add("rounded-t-lg");
						result.classList.remove("hidden");
						result.classList.add("block");
						notfon.classList.remove("block");
						notfon.classList.add("hidden");
					}

					users.forEach((user) => {
						const li = document.createElement("li");
						li.textContent = user.username;
						li.classList.add(
							"userLi",
							"block",
							"px-4",
							"py-2",
							"hover:bg-gray-100"
						);
						li.setAttribute("role", "button");
						result.appendChild(li);

						let liUser = document.querySelectorAll(".userLi");
						liUser.forEach((uli) => {
							uli.addEventListener("click", () => {
								searchUser.value = uli.innerText;
								result.innerHTML = "";
								countResult = null;
								clicked = true;

								if (clicked) {
									searchUser.classList.add("rounded-lg");
									searchUser.classList.remove("rounded-t-lg");
									result.classList.add("hidden");
									btnSendFile.disabled = false;
								} else {
									btnSendFile.disabled = true;
								}
							});
						});
					});
				})
				.catch((error) => {
					console.error(`Error: ${error.message}`);
				});
		} else {
			searchUser.classList.add("rounded-lg");
			searchUser.classList.remove("rounded-t-lg");
			notfon.classList.add("hidden");
			notfon.classList.remove("block");
			result.classList.add("hidden");
			result.classList.remove("block");
			result.innerHTML = "";
			btnSendFile.disabled = true;
		}
	});
