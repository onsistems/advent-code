dots, folds = open("input.txt").read().split("\n\n")
dots = [(int(dot.split(",")[0]), int(dot.split(",")[1])) for dot in dots.splitlines()]
folds = [(axis[-1], int(val)) for fold in folds.splitlines() for axis, val in [fold.split("=")]]

axis, fold_line = folds[0]

for i, (x, y) in enumerate(dots):
    if axis == "x" and x > fold_line:
        dots[i] = (2 * fold_line - x, y)
    if axis == "y" and y > fold_line:
        dots[i] = (x, 2 * fold_line - y)

print(len(set(dots)))