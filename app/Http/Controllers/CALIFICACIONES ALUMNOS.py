"""
sumCalif=0
califminima=10
calificacionmax=0

numalumnos= int(input("ingrese numero de alumnos"))
calificaciones =[]

for i in range ( numalumnos):

    calificacion =float(input( "ingresa la calificacion del alumno: "))
    calificaciones.append(calificacion)
    sumCalif+= calificacion
    

for i in range(numalumnos):
    if calificaciones[i] < califminima:
        califminima= calificaciones[i]
    if calificaciones[i] > calificacionmax:
        calificacionmax = calificaciones[i]
        
promedio = sumCalif/ numalumnos

print(f"promedio{promedio},calificacion max{calificacionmax},calificacion minima {califminima}")

"""
numalumnos = int(input("Ingrese número de alumnos: "))

sumCalif = 0
califminima = 0
calificacionmax = 0

for i in range(numalumnos):
    calificacion = float(input(f"Ingrese la calificación del alumno {i+1}: "))
    sumCalif += calificacion

    # Si es el primer alumno, inicializamos mínima y máxima
    if i == 0:
        califminima = calificacion
        calificacionmax = calificacion
    else:
        if calificacion < califminima:
            califminima = calificacion
        if calificacion > calificacionmax:
            calificacionmax = calificacion

promedio = sumCalif / numalumnos

print(f"Promedio: {promedio}")
print(f"Calificación mínima: {califminima}")
print(f"Calificación máxima: {calificacionmax}")