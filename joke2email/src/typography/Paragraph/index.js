import React from "react";
import classNames from "classnames";
import useStyles from "./styles";
import { Text } from "./styles";

const Paragraph = ({
  size,
  color,
  bold,
  center,
  margin,
  textDecoration,
  className,
  children,
  innerHTML,
  ...others
}) => {
  const classes = useStyles({ center, margin, color, bold });

  return (
    <Text
      {...others}
      size={size}
      bold={bold}
      margin={margin}
      center={center}
      color={color}
      textDecoration={textDecoration}
      className={classNames(classes.root, className)}
    >
      {children}
    </Text>
  );
};

export default Paragraph;
