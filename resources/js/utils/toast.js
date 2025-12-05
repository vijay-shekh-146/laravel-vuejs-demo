import Swal from "sweetalert2"

export function toastSuccess(message) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 2000
    })
}

export function toastError(message) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: message,
        showConfirmButton: false,
        timer: 2000
    })
}
