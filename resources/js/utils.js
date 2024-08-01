export function onError(data) {
    const error = {};
    error.status = data.response.status;
    if (data.response.data.errors) {
        Object.keys(data.response.data.errors).forEach((item) => {
            error.message = data.response.data.errors[item][0];
        });
    } else {
        error.message = data.body.message;
    }
    return error;
}

export function isNumber(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (
        (charCode > 31 && (charCode < 48 || charCode > 57)) ||
        charCode == 46 ||
        charCode == 44
    ) {
        evt.preventDefault();
    } else {
        return true;
    }
}

export function formatDate(dateString) {
    const [year, month, day] = dateString.split("-");
    return `${day}/${month}/${year}`;
}

export function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();

    let month = today.getMonth() + 1;
    let day = today.getDate();

    if (month < 10) {
        month = "0" + month;
    }

    if (day < 10) {
        day = "0" + day;
    }

    return year + "-" + month + "-" + day;
}

export function phoneMask(numero) {
    if (!numero) return "Não informado";
    let celular = numero.replace(/\D/g, "");
    celular = celular.replace(/^(\d{2})(\d)/g, "($1) $2");
    celular = celular.replace(/(\d)(\d{4})$/, "$1-$2");
    return celular;
}

export function getMonthDates() {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;

    const firstDay = new Date(year, month - 1, 1);
    let firstDayMonth = firstDay.getMonth() + 1;
    let firstDayDay = firstDay.getDate();
    if (firstDayMonth < 10) {
        firstDayMonth = "0" + firstDayMonth;
    }
    if (firstDayDay < 10) {
        firstDayDay = "0" + firstDayDay;
    }
    const firstDayFormatted = year + "-" + firstDayMonth + "-" + firstDayDay;

    const lastDay = new Date(year, month, 0);
    let lastDayMonth = lastDay.getMonth() + 1;
    let lastDayDay = lastDay.getDate();
    if (lastDayMonth < 10) {
        lastDayMonth = "0" + lastDayMonth;
    }
    if (lastDayDay < 10) {
        lastDayDay = "0" + lastDayDay;
    }
    const lastDayFormatted = year + "-" + lastDayMonth + "-" + lastDayDay;

    return { firstDayFormatted, lastDayFormatted };
}

