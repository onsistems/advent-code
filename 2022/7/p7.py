def main():
    with open("input.txt", mode="r", encoding="utf8") as file:
        folder_sizes = {}
        folder_path = []

        lines = file.read().splitlines()
        for line in lines:
            commands = line.split()
            if commands[0] == "$":
                if commands[1] == "cd":
                    if commands[2] == "..":
                        folder_path = folder_path[:-1]
                    elif commands[2] == "/":
                        folder_path = ["/"]
                    else:
                        folder_path.append(commands[2])
            else:
                if commands[0] != "dir":
                    current_path = ""
                    for folder in folder_path:
                        if current_path != "/" and folder != "/":
                            current_path += "/"
                        current_path += folder
                        folder_sizes[current_path] = folder_sizes.get(current_path, 0) + int(commands[0])

    # Part 1
    print(sum(value for name, value in folder_sizes.items() if value < 100000))

    # Part 2
    needed_space = 30000000 - (70000000 - folder_sizes.get("/"))
    print(folder_path)
    print(min(value for name, value in folder_sizes.items() if value >= needed_space))


main()