
$(document).ready(function () {
    var validator = $("#registration-form").bootstrapValidator({ feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove", 
        validating: "glyphicon glyphicon-refresh"
    }, 
    fields : {
        IDUsuario : {
            validators : {
                notEmpty : {
                    message: "Identificacion es un campo requerido"
                },
                stringLength : {
                    min: 8,
                    max: 35,

                    message: "Nombres debe tener un largo de 8 a 35"
                }
            }
        },
        Nombres : {
            validators : {
                notEmpty : {
                    message: "Nombres es un campo requerido"
                },
                stringLength : {
                    min: 3,
                    max: 30,
                    message: "Nombres debe tener un largo de 3 a 30"
                }
            }
        },
        Apellidos : {
            validators : {
                notEmpty : {
                    message: "Apellidos es un campo requerido"
                },
                stringLength : {
                    min: 8,
                    max: 35,

                    message: "Nombres debe tener un largo de 8 a 35"
                }
            }
        },
        email :{
            message : "Email es un campo requerido",
            validators : {
                notEmpty : {
                    message : "Ingresar el Email"
                }, 
                stringLength: {
                    min : 6, 
                    max: 35,
                    message: "Email debe tener un largo de 6 a 35"
                },
                emailAddress: {
                    message: "Email es invalido"
                }
            }
        }, 
        password : {
            validators: {
                notEmpty : {
                    message : "Contraseña es un campo requerido"
                },
                stringLength : {
                    min: 8,
                    message: "Contraseña debe tener un largo de 8"
                }, 
                different : {
                    field : "email", 
                    message: "Email y Contraseña no deben ser iguales"
                }
            }
        }, 
        confirmacion : {
            validators: {
                notEmpty : {
                    message: "Confirmación es un campo requerido"
                }, 
                identical : {
                    field: "password", 
                    message : "Contraseña y Confirmación deben ser iguales"
                }
            }
        } 

    }
});
    
    validator.on("success.form.bv", function (e) {
        e.preventDefault();
        $("#registration-form").addClass("hidden");
    });

});
